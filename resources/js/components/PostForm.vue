<template>
    <form :action="this.realAction" method="POST" class="bg-white shadow-lg rounded p-6" enctype="multipart/form-data">
        <slot></slot>
        <input type="hidden" name="_method" value="PUT" v-if="this.isPost">
        <div class="flex flex-col mb-6">
            <label class="text-gray-700 mb-2">Image</label>
            <file-upload :error="this.errors.image" :old="oldPicture"></file-upload>
        </div>
        <div class="flex flex-col mb-6">
            <label for="category" class="text-gray-700 mb-2">Catégorie</label>
            <select name="category" id="category" class="form-select" :class="{'border border-red-600': this.hasCategoryError}" cols="30" rows="6">
                <template v-for="category in categories">
                    <template v-if="isPost">
                        <option :value="category.id" v-if="post.category.name !== category.name">{{ category.name }}</option>
                        <option :value="category.id" selected v-else>{{ category.name }}</option>
                    </template>
                    <template v-else>
                        <option :value="category.id">{{ category.name }}</option>
                    </template>
                </template>
            </select>
            <span class="block text-sm text-red-700 font-bold" v-if="this.hasCategoryError">{{ this.errors.category[0] }}</span>
        </div>
        <div class="flex flex-col mb-6">
            <label for="description" class="text-gray-700 mb-2">Description</label>
            <textarea name="description" id="description" class="form-input" :class="{'border border-red-600': this.hasDescriptionError}" cols="30" rows="6" v-if="this.isPost">{{ this.post.description }}</textarea>
            <textarea name="description" id="description" class="form-input" :class="{'border border-red-600': this.hasDescriptionError}" cols="30" rows="6" v-else></textarea>
            <span class="block text-sm text-red-700 font-bold" v-if="this.hasDescriptionError">{{ this.errors.description[0] }}</span>
        </div>
        <div class="flex">
            <button class="bg-indigo-800 px-4 py-2 text-white rounded border border-indigo-800 mx-2">{{ !this.isPost ? 'Créer une annonce' : 'Modifier cette annonce'}}</button>
            <input type="reset" @click="discardPost" class="bg-transparent px-4 py-2 text-indigo-800 border border-indigo-800 rounded" value="Annuler"/>
        </div>
    </form>
</template>
<script>
    import FileUpload from './FileUpload'
    export default {
        props: [
            "errors",
            "action",
            "categories",
            "post"
        ],
        data() {
            return {
                realAction : this.action,
                oldPicture: null,
            }
        },
        components: {
            FileUpload
        },
        watch: {
            post (newValue, oldValue) {

                if(this.post) {
                    this.realAction = this.post.update_url;
                    this.oldPicture = this.post.url;
                } else {
                    this.realAction = this.action;
                    this.oldPicture = null;
                }
            }
        },
        computed: {
            isErrorsEmpty() {
                return Array.isArray(this.errors) && this.errors.length
            },
            hasCategoryError() {
                return !this.isErrorsEmpty && this.errors.category !== undefined;
            },
            hasDescriptionError() {
                return !this.isErrorsEmpty && this.errors.description !== undefined;
            },
            hasImageError() {
                return !this.isErrorsEmpty && this.errors.image !== undefined;
            },
            isPost() {
                return this.post !== undefined && this.post !== null;
            }
        },
        methods: {
            discardPost() {
                this.$emit('discard')

            }
        }
    }
</script>
