import sys
import pandas as pd
import json
from sklearn.svm import SVC
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score

# Load CSV
file_path = sys.argv[1]
df = pd.read_csv(file_path)

# Assume features and 'stage' column
X = df.drop(['stage'], axis=1)
y = df['stage']

# Split & Train
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2)
model = SVC()
model.fit(X_train, y_train)

# Predict & Accuracy
y_pred = model.predict(X_test)
accuracy = accuracy_score(y_test, y_pred) * 100

# Count by stage
stage_counts = df['stage'].value_counts().to_dict()

# Return JSON
print(json.dumps({
    "accuracy": round(accuracy, 2),
    "total": len(df),
    "stage_1": stage_counts.get("Stage I", 0),
    "stage_2": stage_counts.get("Stage II", 0),
    "stage_3": stage_counts.get("Stage III", 0),
    "raw_data": [df.columns.tolist()] + df.values.tolist()
}))