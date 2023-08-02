<template x-for="(option, index) in question.options">
    <div class="mb-4"
        x-data="{
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
                };
        
                this.checked = true;
        
                if (this.quiz_mode == 'Free') {
                    {{-- add score if correct  --}}
                    if (option.correct_option) {
                        this.score += 1;
                    }
                    {{-- scroll in free mode --}}
                    this.scroll();
                }
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
        }">

        <template x-if="quiz_mode == 'Free'">
            <x-quiz.partials.mcq_free_mode />
        </template>

        <template x-if="quiz_mode == 'Timer'">
            <template x-if="time_left > 0">
                <x-quiz.partials.mcq_timer_mode />
            </template>
        </template>

        <template x-if="quiz_mode == 'Timer' && time_left == 0">
            <x-quiz.partials.mcq_timeout_mode />
        </template>
    </div>
</template>
