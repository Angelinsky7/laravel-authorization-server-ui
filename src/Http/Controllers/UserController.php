<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\User\StoreUserRequest;
use Darkink\AuthorizationServer\Http\Requests\User\UpdateUserRequest;
use Darkink\AuthorizationServer\Policy;
use Darkink\AuthorizationServer\Repositories\UserRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;
use Illuminate\Foundation\Auth\User;

class UserController
{
    use HasSorting, HasSearch;

    protected UserRepository $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
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
        return view('policy-ui::User.create');
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $this->repo->create(
            $validated['name'],
            $validated['email'],
            $validated['password']
        );

        $request->session()->flash('success_message', 'User created.');
        return redirect()->route('policy-ui.user.index');
    }

    public function edit(User $user)
    {
        return view('policy-ui::User.update', [
            'item' => $user
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        $this->repo->update(
            $user,
            $validated['name'],
            $validated['email'],
            $validated['password']
        );

        $request->session()->flash('success_message', 'User updated.');
        return redirect()->route('policy-ui.user.index');
    }

    public function delete(User $user)
    {
        return view('policy-ui::User.delete', [
            'item' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $this->repo->delete($user);

        request()->session()->flash('success_message', 'User deleted.');
        return redirect()->route('policy-ui.user.index');
    }
}
