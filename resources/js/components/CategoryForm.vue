<template>
    <form :action="this.realAction" method="POST" class="bg-white shadow-lg rounded p-6" enctype="multipart/form-data">
        <slot></slot>
        <input type="hidden" name="_method" value="PUT" v-if="this.isCategory">
        <div class="flex flex-col mb-6">
            <label for="name" class="text-gray-700 mb-2">Nom de la catégorie</label>
            <input name="name" id="name" class="form-input" :class="{'border border-red-600': this.hasNameError}" cols="30" rows="6" v-model="this.category.name" v-if="this.isCategory" />
            <input name="name" id="name" class="form-input" :class="{'border border-red-600': this.hasNameError}" cols="30" rows="6" v-else />
            <span class="block text-sm text-red-700 font-bold" v-if="this.hasNameError">{{ this.errors.name[0] }}</span>
        </div>
        <div class="flex">
            <button class="bg-indigo-800 px-4 py-2 text-white rounded border border-indigo-800 mx-2">{{ !this.isCategory ? 'Créer une catégorie' : 'Modifier cette catégorie'}}</button>
            <input type="reset" @click="$emit('discard')" class="bg-transparent px-4 py-2 text-indigo-800 border border-indigo-800 rounded" value="Annuler"/>
        </div>
    </form>
</template>
<script>
    export default {
        props: [
            "errors",
            "action",
            "category"
        ],
        data() {
            return {
                realAction : this.action,
            }
        },
        watch: {
            category (newValue, oldValue) {

                if(this.category) {
                    this.realAction = this.category.update_url;
                } else {
                    this.realAction = this.action;
                }
            }
        },
        computed: {
            isErrorsEmpty() {
                return Array.isArray(this.errors) && this.errors.length
            },
            hasNameError() {
                return !this.isErrorsEmpty && this.errors.name !== undefined;
            },
            isCategory() {
                return this.category !== undefined && this.category !== null;
            }
        }
    }
</script>
