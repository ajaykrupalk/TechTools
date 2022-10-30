<template>
    <a :href="website" target="_blank">
        <div class="bg-gray-900 p-2 rounded w-80 h-80 overflow-hidden border border-1 border-gray-600 hover:border-blue-700">
            <!-- Website Image -->
            <div>
                <img class="rounded w-80 h-44 bg-contain" :src="image" alt=""/>
            </div>
            <div class="flex flex-row gap-2 p-1 tracking-wider">
                <div class="w-full">
                    <!-- Description of Website -->
                    <h1 class="font-medium text-xs w-full mt-1 text-gray-400">
                            {{ description }}
                    </h1>
                </div>
                <!-- Interactive Icons -->
                <div>
                    <div class="flex flex-col justify-start w-fit gap-1">
                        <div class="text-white rounded-md p-1 hover:text-red-500 hover:bg-red-400 hover:bg-opacity-25">
                            <label>
                                <input type="checkbox" class="peer sr-only" name="heart" value="heart" @click="sample" v-model="liked"/>
                                <div class="hidden peer-checked:block peer-checked:text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                    </svg>
                                </div>
                                <div class="w-fit peer-checked:hidden">
                                    <HeartIcon class="h-5 w-5 font-bold"/>
                                </div>
                            </label>
                        </div>
                        <div class="text-white rounded-md p-1 hover:text-orange-500 hover:bg-orange-400 hover:bg-opacity-25">
                            <label>
                                <input type="checkbox" class="peer sr-only" name="bookmark" value="bookmark" @click="bookmark(id)"/>
                                <div class="hidden peer-checked:block peer-checked:text-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0111.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 01-1.085.67L12 18.089l-7.165 3.583A.75.75 0 013.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="w-fit peer-checked:hidden">
                                    <BookmarkIcon class="h-5 w-5 font-bold" />
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</template>

<script>
import { ArrowTopRightOnSquareIcon, PhotoIcon } from '@heroicons/vue/20/solid';
import { BookmarkIcon, HeartIcon } from '@heroicons/vue/24/outline';

import { Bookmark } from "../../services";

export default {
    name: 'DashboardCard',
    components: {
        ArrowTopRightOnSquareIcon,
        BookmarkIcon, 
        HeartIcon,
    },
    data() {
        return {
            liked: false,
        }
    },
    props: {
        website: String,
        image: String,
        description: String,
        id: Number,
    },
    methods: {
        bookmark(toolId){
            Bookmark.store(toolId)
                .then((response) => {
                    console.log(response);
                });
            // $tool_id = id;
        },
        sample() {
            this.liked = !this.liked;
            console.log(this.liked);
            console.log('sample');
        }
    }
}
</script>