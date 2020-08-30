import logging
from argparse import ArgumentParser
from requests import get, HTTPError, ConnectionError
from platform import system as getos
from os import system
from sys import exit
from re import findall
from urllib.parse import unquote
from tqdm import tqdm
from telegram.ext import Updater, CommandHandler, MessageHandler, Filters

logging.basicConfig(format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
                    level=logging.INFO)

logger = logging.getLogger(__name__)

TOKEN = "1063718048:AAE7FttAQ_LUWhxBhhMfI4iYHWXYh27oSs8"


def start(update, context):
    update.message.reply_text('Just paste Url Facebook Video')

def echo(update, context):
    update.message.reply_text("Downloading video !")
    mains(update.message.text, defaultOP(update.message.text))
    update.message.reply_text("Download Complete !")
    update.message.reply_text("sending video !")
    sendVideo(defaultOP(update.message.text))

def main():
    updater = Updater(TOKEN, use_context=True)
    dp = updater.dispatcher
    dp.add_handler(CommandHandler("start", start))
    dp.add_handler(MessageHandler(Filters.text & ~Filters.command, echo))
    updater.start_polling()
    updater.idle()

def sendTo(message):
	system("telegram-send "  + message)
	pass
def TStimeOut():
	sendTo("--timeout 40.0")
	pass

def sendVideo(video):
	TStimeOut()
	sendTo("--video " + video + " --caption '"+ video +"'")
	pass

def banner():
    if getos().lower()[0] != "w":
        system("clear")
    else:
        system("cls")
    pass

def mains(url, path):
    banner()
    print("URL :", url,"\n")
    print("Save As :", path,"")
    link = getdownlink(url)
    download(link, path)
    pass


def download(url, path):
    chunk = 1024  # 1kB
    r = get(url, stream=True)
    total = int(r.headers.get("content-length"))
    print("\n\033[1;34;40mVideo Size :\033[1;33;40m ", round(total / chunk, 2), "KB", end="\n\n")
    with open(path, "wb") as file:
        for data in tqdm(iterable=r.iter_content(chunk_size=chunk), total=total / chunk, unit="KB"):
            file.write(data)
        file.close()

    print("\n\033[1;32;40mDownload Complete !!!")

    pass


def getdownlink(url):
    url = url.replace("www", "mbasic")
    try:
        r = get(url, timeout=5, allow_redirects=True)
        if r.status_code != 200:
            raise HTTPError
        a = findall("/video_redirect/", r.text)
        if len(a) == 0:
            print("\033[1;31;40m[!] Video Not Found...")
            exit(0)
        else:
            return unquote(r.text.split("?src=")[1].split('"')[0])
    except (HTTPError, ConnectionError):
        print("\033[1;31;40m[x] Invalid URL")
        exit(1)
    pass


def defaultOP(url):
    data = url.split("/")
    if data[-1] == "":
        return data[-2] + ".mp4"
    else:
        return data[-1] + ".mp4"


if __name__ == '__main__':
    main()