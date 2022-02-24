<?php

namespace Darkink\AuthorizationServerUI\View\Components\Group;

use Darkink\AuthorizationServer\Repositories\GroupRepository;
use Darkink\AuthorizationServer\Repositories\UserRepository;
use Darkink\AuthorizationServerUI\View\Components\Shared\EntityList as SharedEntityList;

class EntityList extends SharedEntityList
{
    public function __construct(
        GroupRepository $groupRepository,
        UserRepository $userRepository,
        string $id = '',
        string $name = '',
        mixed $items = [],
        mixed $values = [],
        string | null $modalTitle = null,
        string | null $addCaption = null,
        string | null $removeCaption = null,
        bool $remapOldValues = false,
        string | null $addCancelCaption = null,
        string | null $addAddCaption = null,
        string | null $deleteTitle = null,
        string | null $deleteContent = null,
        string | null $deleteActionCaption = null,
        string | null $addDialogTitle = null,
        string | null $deleteDialogTitle = null,
        EntityListMode | string $mode = 'group'
    ) {
        parent::__construct(
            $id,
            $name,
            $items,
            $values,
            $modalTitle ?? _('Add Member'),
            $addCaption ?? _('Add Member'),
            $removeCaption ?? _('Remove Member'),
            $remapOldValues,
            $addCancelCaption ?? _('Cancel'),
            $addAddCaption ?? _('Add'),
            $deleteTitle ?? _('Remove Member'),
            $deleteContent ?? _('Are you sure you want to delete this member ? This action cannot be undone.'),
            $deleteActionCaption ?? _('Remove'),
            $addDialogTitle ?? '',
            $deleteDialogTitle ?? ''
        );

        $mode = is_string($mode) ? EntityListMode::tryFrom($mode) : $mode;

        if (count($this->items) == 0) {
            switch ($mode) {
                case EntityListMode::GROUP:
                    $this->items = $this->_all_groups($groupRepository);
                    break;
                case EntityListMode::USER:
                    $this->items = $this->_all_users($userRepository);
                    break;
                case EntityListMode::ALL:
                    $all_groups = $this->_all_groups($groupRepository);
                    $all_users = $this->_all_users($userRepository);
                    $all_groups_users = array_merge($all_groups->toArray(), $all_users->toArray());
                    usort($all_groups_users, fn ($a, $b) => strcmp($a['order'], $b['order']));
                    $this->items = $all_groups_users;
                    break;
            }
        }
    }

    public function render()
    {
        return view('policy-ui::components.group.entity-list');
    }

    private function _all_groups(GroupRepository $policyRepository,)
    {
        return $policyRepository->gets()->all()->map(fn ($p) => ['value' => 'g' . $p->id, 'item' => ['caption' => $p->display_name, 'type' => 'group'], 'order' => $p->name]);
    }

    private function _all_users(UserRepository $userRepository,)
    {
        return $userRepository->gets()->all()->map(fn ($p) => ['value' => 'u' . $p->id, 'item' => ['caption' => $p->name, 'type' => 'user'], 'order' => $p->name]);
    }
}
