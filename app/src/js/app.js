const app = Vue.createApp({

    data() {
        return {
            comments: [],
            comment: "holis",
            difficulty: 3
        }
    },
    computed: {
        subjectId: () => document.querySelector('#app').dataset.id,
        userId: () => document.querySelector('#app').dataset.userid
    },
    async beforeCreate() {
        try {
            // this.user_id = document.querySelector('#app').dataset.userid
            this.subjectId = document.querySelector('#app').dataset.id
            let subjectId = this.subjectId
            console.log(this.subjectId);
            let res = await fetch("http://tpeweb2careerspath.loc/api/comments")
            let apiData = await res.json()
            this.comments = apiData.filter((x) => x.subject_id == subjectId)
            console.log("asdas")
        } catch (error) {
            console.log(error)
        }
    },

    methods: {
        async deleteComment(id) {
            console.log(id)
            var requestOptions = {
                method: 'DELETE',
                redirect: 'follow'
            }
            try {
                let response = await fetch(`http://tpeweb2careerspath.loc/api/comments/${id}`, requestOptions)
                result = await response.text()
                console.log(result)
            } catch (error) {
                console.log(error)
            }
            this.getComments()
        },
        async getComments() {
            try {
                let subjectId = this.subjectId
                console.log(this.subjectId);
                let res = await fetch("http://tpeweb2careerspath.loc/api/comments")
                let apiData = await res.json()
                this.comments = apiData.filter((x) => x.subject_id == subjectId)
                console.log("asdas")
            } catch (error) {
                console.log(error)
            }
        },
        async createComment() {
            const myHeaders = new Headers()
            myHeaders.append("Content-Type", "application/json")

            const raw = JSON.stringify({
                "user_id": this.userId,
                "subject_id": this.subjectId,
                "comment": this.comment,
                "difficulty": this.difficulty
            })
            console.log(raw);
            const requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            }

            try {
                let response = await fetch("http://tpeweb2careerspath.loc/api/comments", requestOptions)
                let result = await response.text()
                console.log(result)
                this.getComments()
            } catch (error) {
                console.log(error)
            }
        }
    }
});
app.mount('#app');

