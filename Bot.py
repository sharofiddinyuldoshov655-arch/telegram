import telebot
from telebot.types import ReplyKeyboardMarkup, KeyboardButton

TOKEN = "8706298061:AAFCoWrIqIoRNJ5HM2hqgdsI5n6aJ8kF560"
ADMIN_ID = 7975115536

bot = telebot.TeleBot(TOKEN)

buttons_db = []

def main_menu():
    markup = ReplyKeyboardMarkup(resize_keyboard=True)
    for btn in buttons_db:
        markup.add(KeyboardButton(btn))
    if len(buttons_db) == 0:
        markup.add("Hozircha bot bo'sh 😄")
    return markup

@bot.message_handler(commands=['start'])
def start(msg):
    bot.send_message(msg.chat.id,"🤖 BOT KONSTRUKTORGA XUSH KELIBSIZ",reply_markup=main_menu())

@bot.message_handler(commands=['admin'])
def admin(msg):
    if msg.chat.id == ADMIN_ID:
        markup = ReplyKeyboardMarkup(resize_keyboard=True)
        markup.add("➕ Tugma qo'shish")
        bot.send_message(msg.chat.id,"Admin panel",reply_markup=markup)

@bot.message_handler(func=lambda m: m.text == "➕ Tugma qo'shish")
def add_btn(msg):
    if msg.chat.id == ADMIN_ID:
        msg = bot.send_message(msg.chat.id,"Yangi tugma nomini yubor:")
        bot.register_next_step_handler(msg, save_btn)

def save_btn(msg):
    buttons_db.append(msg.text)
    bot.send_message(msg.chat.id,"✅ Tugma qo'shildi!")

print("Bot ishga tushdi...")
bot.infinity_polling()
