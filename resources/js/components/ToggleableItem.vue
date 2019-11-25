<template>
    <div>
        <slot></slot>
    </div>
</template>
<script>
    export default {
        props: [],
        mounted() {
            this.$el.id = ""
        }
    }
</script>
