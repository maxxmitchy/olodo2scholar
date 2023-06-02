<template x-for="(option, index) in question.options">
    <div class="mb-4" x-data="{
        checked: false,

        explanation() {
            return option.explanation?.slice(0, 50) + '...';
        },

        long: function(e) {
            e.target.hidden = true
            this.explanation = option?.explanation;
        },
    
        selectAnswer: function() {
            this.answer = {
                question: this.currentQuestion,
                actualQuestion: question.id,
                option: option.id,
                user_selected: true,
            };
    
            this.checked = true;
    
            {{-- add score if correct  --}}
            if (option.correct_option) {
                this.score += 1;
            }
            {{-- scroll in free mode --}}
            if (this.quiz_mode == 'Free') this.scroll();
        },
    
        scroll: async function() {
            await this.$nextTick();
            setTimeout(() => {
                document.getElementById(correct_id() + '-correct').scrollIntoView({
                    behaviour: 'smooth',
                    block: 'center',
                });
            }, 650)
        },
    
        answerUnansweredQuestions: function() {
            this.questions.forEach((question, key) => {
                if (!this.answers.some(answer => answer.actualQuestion === question.id)) {
                    this.answer = { 
                        question: key, 
                        actualQuestion: question.id, 
                        option: question.correct_option,
                        user_selected: false,
                    };
                }
            });
        }
    }">

        <template x-if="quiz_mode == 'Free'">
            <x-quiz.partials.mcq_free_mode />
        </template>

        <template x-if="quiz_mode == 'Timer'">
            <template x-if="time_left > 0">
                <x-quiz.partials.mcq_timer_mode />
            </template>
            <template x-if="time_left == 0">

            </template>
        </template>
    </div>

</template>
