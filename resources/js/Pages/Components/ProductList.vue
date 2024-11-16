<script setup>
import {computed, ref} from "vue";

const props = defineProps(['productList'])
const emit = defineEmits(['itemClicked']);

const searchTerms = ref("");
const filteredProducts = computed(() => {
	if (searchTerms.value.length < 1) return props.productList;
	return props.productList.filter(item => item.name.toLowerCase().includes(searchTerms.value.toLowerCase()))
})

</script>

<template>
	<section class="products">
		<div class="search">Search :
			<input v-model="searchTerms" type="text">
		</div>
		<ul class="products__container">
			<li v-for="product in filteredProducts" :key="product.id"
				@click.prevent="$emit('itemClicked',product.id)"
				:class="{selected: product?.selected}"
				class="products__item">
				{{ product.id }}
				{{ product.name }}
				{{ product.price }}
				{{ product.stock }} left
				{{ product.category?.name }}
			</li>
		</ul>
	</section>
</template>

<style lang="scss" scoped>
.products__container {
	.products__item {
		cursor: pointer;
	}
	.products__item.selected {
		border: 1px solid black;
	}
}
</style>
