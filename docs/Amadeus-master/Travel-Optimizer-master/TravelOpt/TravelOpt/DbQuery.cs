using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using TravelOpt;
using Npgsql;
using System.Windows.Forms;

namespace pg_data
{
    public class DbQuery : IDatabaseBehavior
    {
        public String queryString;
        public List<Dictionary<String, String>> results = new List<Dictionary<String, String>>();

        public DbQuery(String queryString)
        {
            this.queryString = queryString;
        }

        //public List<Dictionary<String, String>> execute()
        public List<Dictionary<String, String>> getResults()
        {
            Console.WriteLine("The length of results is: " + this.results.Count);
            return this.results;
        }

        public void execute()
        {
            NpgsqlConnection conn = new NpgsqlConnection("Server=pellefant-02.db.elephantsql.com;Port=5432;User Id=lzukdgiw;Password=P3RvimsAf1G_GxCUVwNYGwaKPWSR5Dop;Database=lzukdgiw;");
            try
            {
                conn.Open();
            }
            catch (Exception exp)
            {
                MessageBox.Show("Error :S" + exp);
            }

            List<Dictionary<String, String>> listOfRecords = new List<Dictionary<String, String>>();

            try
            {
                NpgsqlCommand command = new NpgsqlCommand(this.queryString, conn);
                //Console.WriteLine("query: " + this.queryString);
                NpgsqlDataReader dr = command.ExecuteReader();

                while (dr.Read())
                {
                    Dictionary<String, String> tempDictionary = new Dictionary<String, String>();
                    for (int i = 0; i < dr.FieldCount; i++)
                    {
                        tempDictionary.Add((String)dr.GetName(i).ToString(), (String)dr.GetValue(i).ToString());
                    }
                    listOfRecords.Add(tempDictionary);
                }
            }
            catch (Exception exp)
            {
                MessageBox.Show("Error :S" + exp);
            }

            this.results = listOfRecords;

            try
            {
                conn.Close();
            }
            catch (Exception)
            {
                MessageBox.Show("Error :S");
            }
        }
    }
}
