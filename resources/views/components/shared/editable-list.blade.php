<div {{ $attributes }} x-data="window.policy.alpineJs.editableList({
    dataSource: {{ json_encode($dataSource) }}
})">
    <template x-for="(item, index) in dataSource" :key="index">
        {{ $slot }}
    </template>
</div>
