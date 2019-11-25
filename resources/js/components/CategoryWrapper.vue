<template>
    <div class="flex">
        <slot></slot>
        <slot name="table" :category="category" :selectCategory="selectCategory"></slot>
        <slot name="form" :category="category"></slot>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                category: null
            }
        },
        methods: {
            selectCategory (category) {
                this.category = category
                console.log(category)
            }
        }
    }
</script>
