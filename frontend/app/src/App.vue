<script setup lang="ts">
import TweetCreateForm from './components/tweet/TweetCreateForm.vue';
import { useFetch } from './hooks/fetcher';
import {Tweet} from './types/tweet'

  const { data, loading, error, mutate } = useFetch<Tweet[]>('http://localhost/api/tweets')
</script>

<template>
  <div>
    <h1>Tweets</h1>
    <TweetCreateForm :mutate="mutate" />
    <div v-if="loading">Loading...</div>
    <div v-else-if="error">Error: {{ error }}</div>
    <div v-else>
        <p v-for="tweet in data" :key="tweet.id">
          {{ tweet.content }}
        </p>
    </div>
  </div>
</template>

<style scoped>

</style>
