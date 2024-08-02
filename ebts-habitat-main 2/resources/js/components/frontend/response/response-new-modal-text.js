window.ResponseEmojiInput = function(responseModal) {

    $(responseModal).find(':input.emoji-text-input[type="text"], textarea.emoji-text-input').each(function(i){
        $(this).emojioneArea({
            useInternalCDN: true,
            search: false,
            recentEmojis: false,
            pickerPosition: "bottom",
            autocomplete: false,
            tones: false,
            filters: {
                recent : false, // disable recent
                smileys_people: {
                    title: ''
                },
                animals_nature: {
                    title: ''
                },
                food_drink: {
                    title: ''
                },
                activity: {
                    title: '',
                },
                travel_places: {
                    title: '',
                },
                objects: {
                    title: ''
                },
                symbols: {
                    title: ''
                },
                flags : {
                    icon: "flag_es",
                    title: ''
                },
            }
        });
    });
};
