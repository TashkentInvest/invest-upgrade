import pandas as pd
import sqlite3

# Read Excel file into a DataFrame
excel_file_path = 'АПЗ 28-05-2024.xlsx'
data = pd.read_excel(excel_file_path)

# Connect to SQLite database
db_connection = sqlite3.connect('database.sqlite')

# Insert data into the companies table
companies_data = data[['Наименование организации']].dropna()
companies_data.columns = ['company_name']
companies_data.to_sql('companies', db_connection, if_exists='replace', index=False)

# Insert data into the clients table
clients_data = data[['Контакты']].dropna()
clients_data.columns = ['contact']
clients_data.to_sql('clients', db_connection, if_exists='replace', index=False)

# Commit changes and close the connection
db_connection.commit()
db_connection.close()
