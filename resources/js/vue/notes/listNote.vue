<template>
    <div>
        
        <create/>
        <div class="note">
            <div v-for="data in listData" :key="data.id" class="container">
                <header class="header">
                    <input type="text" id="filter" v-bind:placeholder="data.title">
                </header>
                <div class="note-text">{{ data.note }}</div>
            </div>
        </div>

    </div>
</template>

<script>

import Create from './createNoteForm'

export default {
    data () {
        return {
            listData: []
        }
    },
    methods: {
        async getNoteList() {
            const res = await fetch('api/notes?take=100')
            const re = await res.json()
            this.listData = re.data.records;
            console.log(this.listData)
        }
    },
    created: function () {
        this.getNoteList()
    },
    components: {
        Create
    }
}
</script>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

* {
    box-sizing: border-box;
    margin: 0 auto;
}

body {
    background-color: #f8f9fd;
    font-family: 'Roboto', sans-serif;
}

.container  {
    border-radius: 5px;
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
    overflow:hidden;
    width:300px;
    margin-bottom: 100px;
}

.title {
    margin: 0;
}

.subtitle {
    display: inline-block;
    margin: 5px 0 20px;
    opacity: 0.8;
}

.header{
    background-color: #3e57db;
    color: #fff;
    padding: 30px 20px;
}

.header input {
    background-color: rgba(0, 0, 0, 0.3);
    border: 0;
    border-radius: 0px;
    color: #fff;
    font-size: 14px;
    padding: 10px 15px;
    width: 100%;
}

.header input:focus {
    outline: none;
}



.note {
    display: grid;
    gap: 1.5rem;
    grid-template-columns: repeat(3, 1fr);
}

.note-text {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>