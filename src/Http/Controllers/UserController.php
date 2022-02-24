<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\User\StoreUserRequest;
use Darkink\AuthorizationServer\Http\Requests\User\UpdateUserRequest;
use Darkink\AuthorizationServer\Policy;
use Darkink\AuthorizationServer\Repositories\GroupRepository;
use Darkink\AuthorizationServer\Repositories\UserRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;

class UserController
{
    use HasSorting, HasSearch;

    protected UserRepository $repo;
    protected GroupRepository $groupRepository;

    public function __construct(UserRepository $repo, GroupRepository $groupRepository)
    {
        $this->repo = $repo;
        $this->groupRepository = $groupRepository;
    }

    public function index()
    {
        $items = $this->repo->gets()->query();
        $items = $this->addSearchToQueryModel($items);
        $items = $this->addOrderByToQueryModel($items);
        $items = $items->paginate(25)->withQueryString();

        return view('policy-ui::User.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        //TODO(demarco): Please remove for new version
        $all_groups = $this->groupRepository->gets()->all()->map(fn ($p) => ['value' => 'g' . $p->id, 'item' => ['caption' => $p->display_name, 'type' => 'group'], 'order' => $p->name]);

        return view('policy-ui::User.create', [
            'all_groups' => $all_groups,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $this->repo->create(
            $validated['name'],
            $validated['email'],
            $validated['password'],
            $validated['roles'] ?? [],
            $validated['memberofs'] ?? [],
        );

        $request->session()->flash('success_message', 'User created.');
        return redirect()->route('policy-ui.user.index');
    }

    public function edit(int $userId)
    {
        $user = Policy::user()->find($userId);

        //TODO(demarco): Please remove for new version
        $all_groups = $this->groupRepository->gets()->all()->map(fn ($p) => ['value' => 'g' . $p->id, 'item' => ['caption' => $p->display_name, 'type' => 'group'], 'order' => $p->name]);

        return view('policy-ui::User.update', [
            'item' => $user,
            'all_groups' => $all_groups,
        ]);
    }

    public function update(UpdateUserRequest $request, int $userId)
    {
        $user = Policy::user()->find($userId);

        $validated = $request->validated();

        $this->repo->update(
            $user,
            $validated['name'],
            $validated['email'],
            $validated['password'],
            $validated['roles'] ?? [],
            $validated['memberofs'] ?? [],
        );

        $request->session()->flash('success_message', 'User updated.');
        return redirect()->route('policy-ui.user.index');
    }

    public function delete(int $userId)
    {
        $user = Policy::user()->find($userId);

        return view('policy-ui::User.delete', [
            'item' => $user
        ]);
    }

    public function destroy(int $userId)
    {
        $user = Policy::user()->find($userId);

        $this->repo->delete($user);

        request()->session()->flash('success_message', 'User deleted.');
        return redirect()->route('policy-ui.user.index');
    }
}
