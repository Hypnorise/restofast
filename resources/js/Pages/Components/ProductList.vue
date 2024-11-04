<script setup>
const props = defineProps(['productList'])
const emit = defineEmits(['itemClicked']);
</script>

<template>
	<section class="products">
		<ul class="products__container">
			<li v-for="product in productList" :key="product.id"
				@click.prevent="$emit('itemClicked',product.id)"
			class="container__item">
				{{product.id}}
				{{product.name}}
				{{product.price}}
				{{product.stock}}
				{{product.category?.name}}
			</li>
		</ul>
	</section>
</template>

<style scoped lang="scss">
.products__container {
	.container__item {
		cursor : pointer;
	}
}
</style>
