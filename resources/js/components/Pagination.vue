<template>
    <div class="mt-6 -mb-1 flex flex-wrap">
        <template v-for="(link, key) in links">
            <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-grey" :class="{ 'ml-auto': link.label === 'Next' }">{{ link.label }}</div>
            <button @click.prevent="e => reload(link)" v-else :key="key" class="mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo-800 focus:text-indigo-800" :class="{ 'bg-white': link.active, 'ml-auto': link.label === 'Next' }" :href="link.url">{{ link.label }}</button>
        </template>
    </div>
</template>

<script>
    export default {
        props: ['links'],
        methods: {
            reload(link) {
                this.$emit('reload', link.url)
            }
        }
    }
</script>
