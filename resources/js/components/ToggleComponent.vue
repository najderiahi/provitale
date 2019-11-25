<template>
    <div>
        <slot name="trigger" :toggle="handleToggle"></slot>
        <slot name="toggleable" :is-open="isOpen" :close="closeTab" ></slot>
    </div>
</template>
<script>
    export default {
        data ()  {
            return {
                isOpen: false
            };
        },
        methods: {
            handleToggle() {
                this.isOpen = !this.isOpen;
            },
            closeTab() {
                this.isOpen = false;
            }
        }
    }
</script>
