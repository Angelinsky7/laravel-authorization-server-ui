<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Edit Group') }} '{{ $item->name }}'" />
    </x-slot>

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST" action="{{ route('policy-ui.group.update', ['group' => $item->id]) }}">
            @method('PUT')
            @csrf
            <input id="id" name="id" value="{{ $item->id }}" type="hidden" />

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>
                    <x-policy-ui-shared:input-group header="{{ _('Name') }}">
                        <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') ?? $item->name }}" />
                        <x-policy-ui-form-field-error field="name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Display name') }}">
                        <x-policy-ui-shared:input-base id="display_name" name="display_name" type="text" value="{{ old('display_name') ?? $item->display_name }}" />
                        <x-policy-ui-form-field-error field="display_name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Description') }}">
                        {{-- <x-policy-ui-shared:input-base id="description" name="description" type="text" value="{{ old('description') ?? $item->description }}" /> --}}
                        <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') ?? $item->description }}" />
                        <x-policy-ui-form-field-error field="description" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Members of') }}">
                        <x-policy-ui-group:members id="memberofs" name="memberofs"
                                                   modalTitle="{{ _('Add member') }}" addCaption="{{ _('Add member') }}" removeCaption="{{ _('Remove member') }}"
                                                   :values="old('memberofs') ?? $item->memberofs->map(fn($p) => 'g' . $p->id)" remapOldValues="true"
                                                   :items="$all_groups">
                        </x-policy-ui-group:members>
                        <x-policy-ui-form-field-error field="memberofs" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Members') }}">
                        <x-policy-ui-group:members id="members" name="members"
                                                   modalTitle="{{ _('Add member') }}" addCaption="{{ _('Add member') }}" removeCaption="{{ _('Remove member') }}"
                                                   :values="old('members') ?? $item->members()->map(fn($p) => ($p->pivot->member_user_id != null ? 'u' : 'g') . $p->id)" remapOldValues="true"
                                                   :items="$all_groups_users">
                        </x-policy-ui-group:members>
                        <x-policy-ui-form-field-error field="members" />
                    </x-policy-ui-shared:input-group>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link href="{{ route('policy-ui.group.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">{{ _('Update') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>
</x-app-layout>
