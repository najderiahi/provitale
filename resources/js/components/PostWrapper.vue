<template>
    <div class="flex">
        <slot></slot>
        <slot name="table" :post="post" :selectPost="selectPost"></slot>
        <slot name="form" :post="post"></slot>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                post: null
            }
        },
        methods: {
            selectPost (post) {
                this.post = post
                console.log(post)
            }
        }
    }
</script>
