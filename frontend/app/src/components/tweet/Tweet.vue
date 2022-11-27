<script setup lang="ts">
import { ref } from 'vue';
import { Tweet } from '../../types/tweet';

const props = defineProps<{
  tweet: Tweet;
  deleteTweet: (id: number) => void;
  updateTweet: (id: number, newContent: string) => void;
}>()

const isEditable = ref(false);

const toEditMode = () => {isEditable.value = true};
const toViewMode = () => {isEditable.value = false};

const newContent = ref(props.tweet.content);

const onUpdate = () => {
  props.updateTweet(props.tweet.id, newContent.value);
  toViewMode();
}


</script>

<template>
  <p v-if="!isEditable">
    {{ tweet.content }}
  </p>
  <div v-else>
    <input type="text" v-model="newContent" />
    <button @click="onUpdate">更新</button>
    <button @click="toViewMode">キャンセル</button>
  </div>
  <span v-if="!isEditable" @click="toEditMode"><button>編集</button></span>
  <span v-if="!isEditable"><button @click="deleteTweet(tweet.id)">削除</button></span>
</template>