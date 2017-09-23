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
    public class DbManip : IDatabaseBehavior
    {
        public String queryString;

        public DbManip(String queryString)
        {
            this.queryString = queryString;
        }

        public List<Dictionary<String, String>> getResults()
        {
            //Do nothing
            List<Dictionary<String, String>> durp = new List<Dictionary<String, String>>();
            return durp;
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

            // TODO: implement parsing methods to add parameters to query to prevent SQL injection.
            try
            {
                NpgsqlCommand cmd = new NpgsqlCommand(this.queryString, conn);
                cmd.ExecuteNonQuery();
            }
            catch (Exception exp)
            {
                MessageBox.Show("Error :S" + exp);
            }

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
