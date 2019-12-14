<template>
    <div>
        <table class="bg-white rounded shadow-lg overflow-hidden w-full">
            <thead>
            <tr class="py-3 border-b border-gray-300 bg-gray-100">
                <td class="py-2 px-6 text-gray-700">Image</td>
                <td class="py-2 px-6 text-gray-700">Catégorie</td>
                <td class="py-2 px-6 text-gray-700">Description</td>
                <td class="py-2 pr-6 text-gray-700">Actions</td>
            </tr>
            </thead>
            <tbody>
            <template v-if="posts.length">
                <tr class="border-b border-gray-300" v-for="post in this.posts">
                    <td class="py-5 px-6 max-w-auto">
                        <div class="w-24 h-24 rounded shadow-lg overflow-hidden">
                            <img class="w-24 h-24 object-cover"
                                 :src="post.url"
                                 alt="">
                        </div>
                    </td>
                    <td class="py-5 px-6">
                        <span
                            class="bg-orange-200 text-orange-700 px-3 text-xs font-bold tracking-wide uppercase py-2 rounded inline-block">{{ post.category.name }}</span>
                    </td>
                    <td class="text-gray-600 py-5 px-6">
                        <div>{{ post.description }}</div>
                    </td>
                    <td class="py-5 pr-6">
                        <button class="mr-4" @click="updatePost(post)">
                            <svg class="w-4 h-4 fill-current text-gray-600" viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg>
                        </button  >
                        <button @click="deletePost(post.id)">
                            <svg class="w-4 h-4 fill-current text-red-600" viewBox="0 0 20 20"><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/></svg>
                        </button>
                    </td>
                </tr>
            </template>
            <template v-else>
                <tr class="flex justify-content-center items-center p-6 text-gray-700" colspan="0">Pas d'annonces
                    disponibles
                </tr>
            </template>
            </tbody>
        </table>
        <pagination :links="this.links" @reload="handleReload"></pagination>
    </div>
</template>

<script>
    import axios from 'axios'
    import Pagination from './Pagination'

    export default {
        props: ['selectPost'],
        data() {
            return {
                posts: [],
                links: []
            }
        },
        components: {Pagination},
        created() {
            this.getPosts().then(payload => {
                this.posts = payload.data;
                this.links = payload.links;
            });
        },
        methods: {
            async getPosts(url = '/api/posts') {
                let response = await axios.get('/api/posts')
                return response.data
            },
            handleReload(url) {
                this.getPosts(url).then(payload => {
                    this.posts = payload.data;
                    this.links = payload.links;
                })
            },
            updatePost(post) {
                this.$emit("update", post)
            },
            async deletePost(id) {
                let response = await axios.delete('/api/post/'+id);
                if(response.status == 202) {
                    this.getPosts().then(payload => {
                        this.posts = payload.data;
                        this.links = payload.links;
                    });
                }
            }
        }
    }
</script>
