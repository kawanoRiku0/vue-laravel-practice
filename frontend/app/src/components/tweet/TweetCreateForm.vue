<script setup lang="ts">
import { ref } from 'vue';
import { remoteFetch } from '../../utils/fetchers';

  const props = defineProps<{mutate: () => void}>()

  const content = ref('')
  const error = ref('')

  const createTweet = async () => {
    if(!content.value) {
      error.value = 'ツイートは一文字以上で入力してください。'
      return
    }
    
    const response = await remoteFetch('http://localhost/api/tweets','POST', {content: content.value})

    if (response.error) {
      error.value = response.message
    } else {
      content.value = ''
      error.value = ''
      props.mutate();
    }
  }

</script>

<template>
  <div>
    <form @submit.prevent>
      <label>
        <input type="text" v-model="content">
      </label>
      <button class="create-button" @click="createTweet">投稿</button>
    </form>
    <p v-if="error" style="color: red;">{{ error }}</p>
  </div>
</template>

<style scoped>
.create-button {
  background-color: #1da1f2;
  color: #fff;
  border: none;
  border-radius: 9999px;
  padding: 8px 16px;
  font-size: 14px;
  font-weight: bold;
  cursor: pointer;
}
</style>