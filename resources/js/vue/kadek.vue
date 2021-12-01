<template>
    <div>
        <p>hello kadek</p>
        <button v-on:click="getList()">get list user</button>
        <p v-for="data in listData" :key="data.id"> NAME: {{ data.name.title }} {{ data.name.first }} {{ data.name.last}} </p>
</template>


<script>
export default {
    data() {
        return {
            listData: []
        }
    },
    created: function() {
        this.getList()
    },
    methods: {
        async getList() {
            console.log('hello')
            const res = await fetch('https://randomuser.me/api?results=10')
            const re = await res.json()
            //console.log(re)
            this.listData = re.results;

        }
    }
}
</script>