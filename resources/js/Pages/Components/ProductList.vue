<script setup>
const props = defineProps(['productList'])
</script>

<template>
	<section class="products">
		<ul class="products__container">
			<li v-for="product in productList"
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
