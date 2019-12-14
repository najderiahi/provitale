<template>
    <div class="bg-white h-64 overflow-hidden relative" @mouseover="hover = true" @mouseleave="hover = false">
        <img class="w-full h-full object-cover object-center item-image" :class="{active: hover}" :src="this.image" alt="">
        <div class="absolute z-20 bottom-0 inset-x-0 bg-gray-700 h-1/2 p-2 item" :class="{active: hover}">
            <p class="text-gray-200 text-center text-xl h-20">{{ this.desc}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['image', 'description'],
        data ()  {
            return {
                hover: false,
            }
        },
        computed: {
            desc () {
                return this.description.length <= 30 ? this.description : this.description.substr(0, 30).concat("...");
            }
        }
    }
</script>

<style>
    .item {
        transform: translateY(200%);
        transform-origin: bottom;
        transition: all .4s ease;
    }

    .item.active {
        transform: translateY(0);
    }

    .item-image {
        transition: all .4s ease;
    }

    .item-image.active {
        transform: translateY(-40px);
    }
</style>
