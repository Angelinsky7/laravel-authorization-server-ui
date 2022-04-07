<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Client\StoreClientRequest;
use Darkink\AuthorizationServer\Http\Requests\Client\UpdateClientRequest;
use Darkink\AuthorizationServer\Policy;
use Darkink\AuthorizationServer\Repositories\GroupRepository;
use Darkink\AuthorizationServer\Repositories\ClientRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;
use phpseclib3\Crypt\Salsa20;

class ClientController
{
    use HasSorting, HasSearch;

    protected ClientRepository $repo;

    public function __construct(ClientRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $items = $this->repo->gets();
        $items = $this->addSearchToQueryModel($items);
        $items = $this->addOrderByToQueryModel($items);
        $items = $items->paginate(25)->withQueryString();

        return view('policy-ui::Client.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('policy-ui::Client.create');
    }

    public function store(StoreClientRequest $request)
    {
        $validated = $request->validated();

        $this->repo->create(
            $validated['name'],
            $validated['user_id'],
            $validated['secret'],
            $validated['provider'],
            $validated['redirect'],
            $validated['personal_access_client'] ?? false,
            $validated['password_client'] ?? false,
            $validated['revoked'] ?? false,
            $validated['enabled'] ?? false,
            // $validated['client_id'],
            $validated['require_client_secret'] ?? false,
            $validated['client_name'],
            $validated['description'],
            $validated['client_uri'],
            $validated['policy_enforcement'],
            $validated['decision_strategy'],
            $validated['permission_splitter'] ?? '#',
            $validated['analyse_mode_enabled'] ?? false,
            $validated['json_mode_enabled'] ?? false,
            $validated['all_resources'] ?? false,
            $validated['all_scopes'] ?? false,
            $validated['all_roles'] ?? false,
            $validated['all_groups'] ?? false,
            $validated['all_policies'] ?? false,
            $validated['all_permissions'] ?? false,
            $validated['permissions'] ?? []
        );

        $request->session()->flash('success_message', 'Client created.');
        return redirect()->route('policy-ui.client.index');
    }

    public function edit(string | int $clientId)
    {
        $client = Policy::oauthClient()->with('client')->find($clientId);

        return view('policy-ui::Client.update', [
            'item' => $client
        ]);
    }

    public function update(UpdateClientRequest $request, string | int $clientId)
    {
        $oauth = Policy::oauthClient()->find($clientId);
        $client = $oauth->client;

        $validated = $request->validated();

        if ($client == null) {
            $client =  Policy::client()->forceFill([
                'oauth_id' => $clientId,
                'enabled' => $validated['enabled'] ?? false,
                'client_id' => $validated['client_id'],
                'require_client_secret' => $validated['require_client_secret'] ?? false,
                'client_name' => $validated['client_name'],
                'description' => $validated['description'],
                'client_uri' => $validated['client_uri'],
                'policy_enforcement' => $validated['policy_enforcement'],
                'decision_strategy' => $validated['decision_strategy'],
                'analyse_mode_enabled' => $validated['analyse_mode_enabled'] ?? false,
                'json_mode_enabled' => $validated['json_mode_enabled'] ?? false
            ]);
            $client->save();
            $oauth->client()->save($client);
            $oauth->save();
        }

        $this->repo->update(
            $client,
            $validated['name'],
            $validated['user_id'],
            $validated['secret'],
            $validated['provider'],
            $validated['redirect'],
            $validated['personal_access_client'] ?? false,
            $validated['password_client'] ?? false,
            $validated['revoked'] ?? false,
            $validated['enabled'] ?? false,
            // $validated['client_id'],
            $validated['require_client_secret'] ?? false,
            $validated['client_name'],
            $validated['description'],
            $validated['client_uri'],
            $validated['policy_enforcement'],
            $validated['decision_strategy'],
            $validated['permission_splitter'] ?? '#',
            $validated['analyse_mode_enabled'] ?? false,
            $validated['json_mode_enabled'] ?? false,
            $validated['all_resources'] ?? false,
            $validated['all_scopes'] ?? false,
            $validated['all_roles'] ?? false,
            $validated['all_groups'] ?? false,
            $validated['all_policies'] ?? false,
            $validated['all_permissions'] ?? false,
            $validated['permissions'] ?? []
        );

        $request->session()->flash('success_message', 'Client updated.');
        return redirect()->route('policy-ui.client.index');
    }

    public function delete(int $clientId)
    {
        $Client = Policy::Client()->find($clientId);

        return view('policy-ui::Client.delete', [
            'item' => $Client
        ]);
    }

    public function destroy(int $clientId)
    {
        $client = Policy::Client()->find($clientId);

        $this->repo->delete($client);

        request()->session()->flash('success_message', 'Client deleted.');
        return redirect()->route('policy-ui.client.index');
    }
}
