<script setup>
import {ref} from "vue";

const props = defineProps(['categoryList']);
const emit = defineEmits(['categoryChanged']);

const activeCategory = ref(null)
</script>

<template>
	<section class="categories">
		<ul class="categories__container">
			<li class="active">All</li>
			<li v-for="category in categoryList" @click.prevent="$emit('categoryChanged',category.id)"
			class="container__item">{{category.name}}</li>
		</ul>
	</section>
</template>

<style scoped>
ul li {
	cursor: pointer;
	&:hover {
		text-decoration: underline;
	}
	&.active {
		text-decoration: underline;
		font-weight : bold;
	}
}
</style>
