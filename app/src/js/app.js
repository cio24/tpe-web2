const app = Vue.createApp({

    data() {
        return {
          comments: [],
          comment: "",
          difficulty: 1,
          sortBy: "date",
          order: "asc",
          difficultyFilterValue: null,
        };
    },
    computed: {
        userId: () => Number(document.querySelector('#app').dataset.user_id),
        subjectId: () => Number(document.querySelector('#app').dataset.id)
    },
    async created() {
        try {
            let res = await fetch("http://tpeweb2careerspath.loc/api/comments?subject_id=" + this.subjectId);
            let apiData = await res.json()
            this.comments = apiData
        } catch (error) {
            console.log(error)
        }
    },

    methods: {
        async deleteComment(id) {
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
                let res = await fetch("http://tpeweb2careerspath.loc/api/comments?subject_id=" + this.subjectId)
                let apiData = await res.json()
                this.comments = apiData
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
        },
        async filterOrUpdate(){
            const sortBy = this.sortBy == "date" ? "id" : this.sortBy
            let url = `http://tpeweb2careerspath.loc/api/comments?sortBy=${sortBy}&orderBy=${this.order}&subject_id=${this.subjectId}`
            if(this.difficultyFilterValue != null)
                url += `&filterByDifficulty=${this.difficultyFilterValue}`

            try {
                let response = await fetch(url)
                let result = await response.json()
                this.comments = result
            }
            catch (error) {
                console.log(error)
            }

        }
    }
});
app.mount('#app');

