def number_to_text(number):
    # Define dictionaries for the textual representation of numbers
    ones = ['', 'bir', 'ikki', 'uch', 'toʻrt', 'besh', 'olti', 'yetti', 'sakkiz', 'to‘qqiz']
    teens = ['o‘n', 'o‘n bir', 'o‘n ikki', 'o‘n uch', 'o‘n to‘rt', 'o‘n besh', 'o‘n olti', 'o‘n yetti', 'o‘n sakkiz', 'o‘n to‘qqiz']
    tens = ['', '', 'yigirma', 'otuz', 'qirq', 'ellik', 'oltmish', 'yetmish', 'sakson', 'to‘qson']
    
    # Function to convert two-digit numbers
    def convert_below_100(num):
        if num < 10:
            return ones[num]
        elif num < 20:
            return teens[num - 10]
        else:
            return tens[num // 10] + (' ' + ones[num % 10] if num % 10 != 0 else '')
    
    # Function to convert three-digit numbers
    def convert_below_1000(num):
        hundred = ones[num // 100] + ' yuz ' if num // 100 != 0 else ''
        below_100 = convert_below_100(num % 100)
        return f"{hundred}{'va ' if hundred and below_100 else ''}{below_100}"
    
    # Function to convert numbers up to billions
    def convert(number):
        if number < 1000:
            return convert_below_1000(number)
        elif number < 1000000:
            return convert(number // 1000) + ' ming ' + convert(number % 1000)
        elif number < 1000000000:
            return convert(number // 1000000) + ' million ' + convert(number % 1000000)
        elif number < 1000000000000:
            return convert(number // 1000000000) + ' milliard ' + convert(number % 1000000000)
        else:
            return "Raqam chegaradan tashqari (0 va 999,999,999,999 orasida bo'lishi kerak)."
    
    # Special case for zero
    if number == 0:
        return 'nol'
    
    # Main conversion
    return convert(number)

# Example usage
number = 14320001
text_representation = number_to_text(number)
print(text_representation)
