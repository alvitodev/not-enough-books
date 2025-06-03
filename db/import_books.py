import pandas as pd
import mysql.connector

# Connect to MySQL
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",  # or your actual password
    database="notenoughbooks"
)
cursor = conn.cursor()

# Read the Excel file
df = pd.read_excel("DataBuku.xlsx")

for index, row in df.iterrows():
    try:
        sql = """
        INSERT INTO books (id, title, author, publisher, year, description, cover_img, category)
        VALUES (%s, %s, %s, %s, %s, %s, %s, %s)
        """
        values = (
            row.get('id'),
            row.get('title'),
            row.get('author'),
            row.get('publisher'),
            row.get('year'),
            row.get('description'),
            row.get('cover_img'),
            row.get('category'),
        )

        # Skip rows with missing critical data
        if any(v is None for v in values):
            print(f"Skipping row {index+1} due to missing data.")
            continue

        cursor.execute(sql, values)

    except Exception as e:
        print(f"Error on row {index+1}: {e}")

conn.commit()
cursor.close()
conn.close()