<script setup>
import {ref} from "vue";

const props = defineProps(['categoryList']);
const emit = defineEmits(['categoryChanged']);

const activeCategory = ref(null);
function changeCategory(id) {
	activeCategory.value = id
	emit('categoryChanged', id)
}

</script>

<template>
	<article class="categories">
		<ul class="categories__container">
			<li :class="{active: activeCategory==null}" @click.prevent="changeCategory(null)">All</li>
			<li v-for="category in categoryList" :class="{active: activeCategory==category.id}"
				class="container__item"
				@click.prevent="changeCategory(category.id)">{{ category.name }}
			</li>
		</ul>
	</article>
</template>

<style scoped>
ul li {
	cursor : pointer;
	&:hover {
		text-decoration : underline;
	}
	&.active {
		text-decoration : underline;
		font-weight     : bold;
	}
}
</style>
