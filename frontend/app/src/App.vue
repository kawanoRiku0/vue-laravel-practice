<script setup lang="ts">
import { ref } from 'vue';
import TweetCreateForm from './components/tweet/TweetCreateForm.vue';
import TweetComponent from './components/tweet/Tweet.vue';
import { useFetch } from './hooks/fetcher';
import {Tweet} from './types/tweet'
import { remoteFetch } from './utils/fetchers';

  const { data, loading, error, mutate } = useFetch<Tweet[]>('http://localhost/api/tweets');

  const errorMessage = ref("");

  const deleteTweet = async (id: number) => {
    const response = await  remoteFetch(`http://localhost/api/tweets/${id}`, 'DELETE')
    if (response.error || response.message) {
      errorMessage.value = response.message
    } else {
      errorMessage.value = ''
      mutate();
    }  
  }

  const updateTweet = async (id: number, newContent: string) => {
    if(!newContent) {
      errorMessage.value = 'ツイートは一文字以上にしてください。'
      return
    }
    const response = await  remoteFetch(`http://localhost/api/tweets/${id}`, 'PUT', { content: newContent})
    if (response.error || response.message) {
      errorMessage.value = response.message
    } else {
      errorMessage.value = ''
      mutate();
    }  
}

</script>

<template>
  <div>
    <h1>Tweets</h1>
    <TweetCreateForm :mutate="mutate" />
    <p v-if="errorMessage" style="color: red;">{{ errorMessage }}</p>
    <div v-if="loading">Loading...</div>
    <div v-else-if="error">Error: {{ error }}</div>
    <div v-else>
        <TweetComponent v-for="tweet in data" :key="tweet.id" :tweet="tweet" :delete-tweet="deleteTweet" :update-tweet="updateTweet" />          
    </div>
  </div>
</template>

<style scoped>

</style>
