import sys
import json
from deepface import DeepFace

# Get image file from argument
img_path = sys.argv[1]

try:
    result = DeepFace.analyze(img_path=img_path, actions=['emotion'], enforce_detection=False)
    mood = result[0]['dominant_emotion']

    # Song suggestion
    mood_songs = {
        "happy": "Happy - Pharrell Williams",
        "sad": "Someone Like You - Adele",
        "angry": "Breaking the Habit - Linkin Park",
        "surprise": "Surprise Yourself - Jack Garratt",
        "neutral": "Let It Be - The Beatles",
        "fear": "Boulevard of Broken Dreams - Green Day",
        "disgust": "Rolling in the Deep - Adele"
    }

    song = mood_songs.get(mood, "Let It Be - The Beatles")

    print(json.dumps({"mood": mood, "song": song}))

except Exception as e:
    print(json.dumps({"error": str(e)}))
