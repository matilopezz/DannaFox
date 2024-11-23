function updateCharacterCount() {
    const maxLength = 160;
    const smsText = document.getElementById("sms_text");
    const charCount = document.getElementById("charCount");
    const remaining = maxLength - smsText.value.length;
    charCount.textContent = remaining;
}