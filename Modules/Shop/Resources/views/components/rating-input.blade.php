<div style="display: flex;justify-content: start;flex-direction: column">
    <style>
        .rate-area {
            float: left;
            border-style: none;
        }

        .rate-area:not(:checked)>input {
            display: none
                /* position: absolute;
            top: -9999px;
            clip: rect(0, 0, 0, 0); */
        }

        .rate-area:not(:checked)>label {
            float: right;
            width: 0.8em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 180%;
            color: lightgrey;
        }

        .rate-area:not(:checked)>label:before {
            content: "★";
        }

        .rate-area>input:checked~label {
            color: orangered;
        }

        .rate-area:not(:checked)>label:hover,
        .rate-area:not(:checked)>label:hover~label {
            color: orangered;
        }

        .rate-area>input:checked+label:hover,
        .rate-area>input:checked+label:hover~label,
        .rate-area>input:checked~label:hover,
        .rate-area>input:checked~label:hover~label,
        .rate-area>label:hover~input:checked~label {
            color: orangered;
        }
    </style>
    <ul style="padding: 0;margin: 0" class="rate-area">
        <input type="radio" id="5-star" wire:model='rating' name="rating" value="5" />
        <label for="5-star" title="عالی">5
            stars
        </label>
        <input type="radio" id="4-star" wire:model='rating' name="rating" value="4" />
        <label for="4-star" title="خوب">4
            stars
        </label>
        <input type="radio" id="3-star" wire:model='rating' name="rating" value="3" />
        <label for="3-star" title="متوسط">3
            stars
        </label>
        <input type="radio" id="2-star" wire:model='rating' name="rating" value="2" />
        <label for="2-star" title="بد">2
            stars
        </label>
        <input type="radio" id="1-star" wire:model='rating' name="rating" value="1" />
        <label for="1-star" title="خیلی بد">1
            star
        </label>
    </ul>
    @error('rating')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
