<script setup>
import CategoryList from "@/Pages/Components/CategoryList.vue";
import ProductList from "@/Pages/Components/ProductList.vue";

let props = defineProps(["productList","categoryList"])
</script>

<template>
	<CategoryList :categoryList/>
	<ProductList :productList/>
</template>

<style scoped>

</style>
