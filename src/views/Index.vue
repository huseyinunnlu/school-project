<template>
    <div>
    </div>
</template>
<script>
export default {
    created(){
        this.$appAxios.get('/asads')
        console.log(this.$store.getters._User)
    }
}
</script>