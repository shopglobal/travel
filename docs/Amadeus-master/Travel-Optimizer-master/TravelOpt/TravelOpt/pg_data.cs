using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Npgsql;
using System.Windows.Forms;

namespace pg_data
{
    class pgsqlDml : dbAbstract
    {
        public pgsqlDml(String queryString)
        {
            dbBehavior = new DbManip(queryString);
        }
        public override void execute()
        {
            dbBehavior.execute();
        }
    }

    class pgsqlQuery : dbAbstract
    {
        public List<Dictionary<String, String>> results;
        public pgsqlQuery(String queryString)
        {
            dbBehavior = new DbQuery(queryString);
        }

        public override void execute()
        {
            dbBehavior.execute();
            this.results = dbBehavior.getResults();
        }
    }
}
