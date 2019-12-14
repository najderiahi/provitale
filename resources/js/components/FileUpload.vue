<template>
    <div class="relative">
        <div class="relative inline-block">
            <div class="w-32 h-32 rounded shadow overflow-hidden" :class="{'border border-red-600': this.isErrorEmpty}">
                <img :src="url" alt="" v-show="canBeCancelled" class="w-full h-full object-cover">
            </div>
            <label
                class="cursor-pointer absolute w-8 h-8 bottom-0 bg-indigo-800 rounded-full -mr-2 -mb-2 shadow right-0 flex justify-center items-center">
                <span>
                    <svg class="w-4 h-4 fill-current text-gray-200" viewBox="0 0 20 20"><path
                        d="M13 10v6H7v-6H2l8-8 8 8h-5zM0 18h20v2H0v-2z"/></svg>
                </span>
                <input ref="fileInput" type="file" name="image" @change="readUrl" class="invisible absolute inset-0">
            </label>
        </div>
        <span class="block text-sm text-red-700 font-bold" v-if="this.isErrorEmpty">{{ this.error[0] }}</span>
    </div>
</template>

<script>
    export default {
        props: ["old", "error"],
        data() {
            return {
                url: '',
            }
        },
        mounted() {
            if (this.old) {
                this.url = this.old;
            }
        },
        watch: {
            old (newValue, oldValue) {
                if(newValue) {
                    this.url = newValue;
                } else {
                    this.url = '';
                }
            }
        },
        methods: {
            readUrl() {
                if (this.$refs.fileInput.files && this.$refs.fileInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.url = e.target.result
                    };
                    reader.readAsDataURL(this.$refs.fileInput.files[0]);
                    return;
                }
            }
        },
        computed: {
            canBeCancelled() {
                return this.url !== '';
            },
            isErrorEmpty() {
                return Array.isArray(this.error) && this.error.length
            }
        }
    }
</script>
