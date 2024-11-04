<script setup>
const props = ['categoriesList'];
const emit = ['categoryChanged'];


</script>

<template>
	<section class="categories">
		<ul class="categories__container">
			<li v-for="category in categoriesList" @click.prevent="$emit('categoryChanged',category.id)"
			class="container__item">{{category.name}}</li>
		</ul>
	</section>
</template>

<style scoped>

</style>
