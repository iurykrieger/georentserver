using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GeoRent.Infra.Data.Context
{
    class GeoRentContext : DbContext
    {
        public AppMuseuContext() 
            : base("DefaultConnection")
        {
        }
}
