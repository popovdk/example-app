<script setup>

import NewsCard from "@/Pages/Dashboard/Partials/NewsCard.vue";
import {computed, onMounted, onUpdated, ref, watch} from "vue";
import Pagination from "@/Components/Pagination.vue";
import TextInput from "@/Components/TextInput.vue";
import {router, useForm} from "@inertiajs/vue3";

const props = defineProps({
  news: Object,
  query: String
})

const firstColumn = computed(() => props.news.data.filter((_, index) => index % 3 === 0));
const secondColumn = computed(() => props.news.data.filter((_, index) => index % 3 === 1));
const thirdColumn =  computed(() => props.news.data.filter((_, index) => index % 3 === 2));


const search = ref(props.query)

watch(search, (value) => {
  router.get(route('dashboard'), { search: value }, { preserveState: true, preserveScroll: true });
});

</script>

<template>
  <div>
    <TextInput
        id="search"
        type="text"
        class="mt-1 block w-full"
        v-model="search"
        placeholder="Search..."
    />

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-8">
      <div class="grid gap-4">
        <NewsCard v-for="item in firstColumn"
                  :key="news.title"
                  :title="item.title"
                  :url="item.url"
                  :description="item.description"
                  :publishedAt="item.published_at"
                  :source="item.source"
                  :previewUrl="item.preview_url"
        />
      </div>
      <div class="grid gap-4">
        <NewsCard v-for="item in secondColumn"
                  :key="news.title"
                  :title="item.title"
                  :url="item.url"
                  :description="item.description"
                  :publishedAt="item.published_at"
                  :source="item.source"
                  :previewUrl="item.preview_url"
        />
      </div>
      <div class="grid gap-4">
        <NewsCard v-for="item in thirdColumn"
                  :key="news.title"
                  :title="item.title"
                  :url="item.url"
                  :description="item.description"
                  :publishedAt="item.published_at"
                  :source="item.source"
                  :previewUrl="item.preview_url"
        />
      </div>
    </div>

    <pagination :links="news.links" />

    <div class="grid grid-cols-3 gap-5" v-if="false">
      <NewsCard v-for="item in news"
                :key="news.title"
                :title="item.title"
                :url="item.url"
                :description="item.description"
                :publishedAt="item.published_at"
                :source="item.source"
                :previewUrl="item.preview_url"
      />
    </div>
  </div>

</template>

<style scoped>

</style>
