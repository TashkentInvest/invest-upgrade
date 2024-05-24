<template>
<div>
    <div class="Message_icon__MBR+g" style="font-size: 30px; margin-right: 5px;">📥</div>
    <b>{{ name }} {{ size }} </b>
    <span>{{ description }}</span>
</div>
</template>

<script>

export default {
    props: {
        name: {
            type: String,
        },
        size: {
            type: String,
        },
        description: {
            type: String,
        }
    },
    setup() {

    },
};
</script>

<style scoped>
span{
    margin-left: 5px;
}
</style>