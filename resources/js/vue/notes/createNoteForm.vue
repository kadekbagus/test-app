<template>
    <div class="container">
        <h2>Notes</h2>
        <input type="text" v-model="title">
        <textarea name="" id="" cols="30" rows="10" v-model="note"></textarea>
        <button v-on:click="createNote()">add</button>
    </div>
</template>

<script>

export default {
    data () {
        return {
            title: null,
            note: null,
        }
    },
    methods: {
        createNote () {
            this.postData('api/note/store', { title: this.title, note: this.note })
            .then(data => {
                console.log(data);
                this.clearForm(); // JSON data parsed by `data.json()` call
            });
        },
        async postData(url = '', data = {}) {
            // Default options are marked with *
            const response = await fetch(url, {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                'Content-Type': 'application/json'
                // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify(data) // body data type must match "Content-Type" header
            });
            return response.json(); // parses JSON response into native JavaScript objects
        },
        clearForm: function (e) {
            this.title = ''
            this.note = ''
        }
    }
}
</script>
