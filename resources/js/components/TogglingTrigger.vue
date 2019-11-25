<template>
    <button type="button" @click="emitToggle">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        methods: {
            emitToggle() {
                this.$emit('toggle')
            }
        }
    }
</script>
