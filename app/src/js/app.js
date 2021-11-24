const app = Vue.createApp({
  data() {
    return {
      comments: [],
      comment: "",
      difficulty: 1,
      sortBy: "date",
      order: "asc",
      difficultyFilterValue: null,
      error: false,
      message: "",
    };
  },
  computed: {
    userId: () => Number(document.querySelector("#app").dataset.user_id),
    subjectId: () => Number(document.querySelector("#app").dataset.id),
  },
  async created() {
    try {
      let response = await fetch(
        `http://tpeweb2careerspath.loc/api/comments?subject_id=${this.subjectId}`
      );
      if (!response.ok) throw new Error(await response.text());
      else {
        this.comments = await response.json();
        this.message = "";
      }
    } catch (error) {
      this.message = error;
    }
  },

  methods: {
    async deleteComment(id) {
      let requestOptions = {
        method: "DELETE",
        redirect: "follow",
      };
      try {
        await fetch(
          `http://tpeweb2careerspath.loc/api/comments/${id}`,
          requestOptions
        );
        this.getComments();
        this.message = "";
      } catch (error) {
        this.message = "There was an error.";
      }
    },

    async getComments() {
      try {
        let response = await fetch(
          `http://tpeweb2careerspath.loc/api/comments?subject_id=${this.subjectId}`
        );
        if (!response.ok) throw new Error(await response.text());
        else this.message = "";

        this.comments = await response.json();
      } catch (error) {
        this.error = true;
        this.message = error;
      }
    },

    async createComment() {
      const myHeaders = new Headers();
      myHeaders.append("Content-Type", "application/json");

      const raw = JSON.stringify({
        user_id: this.userId,
        subject_id: this.subjectId,
        comment: this.comment,
        difficulty: this.difficulty,
      });
      const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow",
      };

      try {
        const response = await fetch(
          "http://tpeweb2careerspath.loc/api/comments",
          requestOptions
        );
        if (!response.ok) throw new Error(await response.text());
        else {
          this.getComments();
          this.message = "";
        }
      } catch (error) {
        this.error = true;
        this.message = error;
      }
    },

    async filterOrUpdate() {
      const sortBy = this.sortBy == "date" ? "id" : this.sortBy;
      let url = `http://tpeweb2careerspath.loc/api/comments?sortBy=${sortBy}&orderBy=${this.order}&subject_id=${this.subjectId}`;
      if (this.difficultyFilterValue != null)
        url += `&filterByDifficulty=${this.difficultyFilterValue}`;

      try {
        let response = await fetch(url);
        if (!response.ok) throw new Error(await response.text());
        else {
          this.comments = await response.json();
          this.message = "";
        }
      } catch (error) {
        this.error = true;
        console.log("holanduski");
        console.log(error);
        this.message = error;
      }
    },
  },
});
app.mount("#app");
