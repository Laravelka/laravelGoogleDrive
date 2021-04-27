<template>
	<div></div>
</template>

<script>
	import axios from 'axios';

	export default {
		async mounted() {
			axios.get('user').then((response) => {
				console.log(response.data);
			}).catch((error) => {
				console.log(error.response.data);
			});
		}
	}
</script>
