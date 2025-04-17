<input type="radio" id="option1" name="choice" value="1">
<label for="option1">Option 1</label>

<input type="radio" id="option2" name="choice" value="2" checked>
<label for="option2">Option 2</label>




<style>
    input[type="radio"] {
        appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid gray;
        border-radius: 50%;
        outline: none;
        cursor: pointer;
        position: relative;
    }

    /* Checked state style */
    input[type="radio"]:checked::before {
        content: "";
        position: absolute;
        top: 4px;
        left: 4px;
        width: 10px;
        height: 10px;
        background-color: yellow;
        border-radius: 50%;
    }
</style>