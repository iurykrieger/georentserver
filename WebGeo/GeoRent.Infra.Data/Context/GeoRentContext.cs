using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Data.Entity.ModelConfiguration.Conventions;
using System.Text;
using System.Threading.Tasks;
using GeoRent.Domain.Entities;

namespace GeoRent.Infra.Data.Context
{
    class GeoRentContext : DbContext
    {
        public GeoRentContext()
            : base("GeoRentBase")
        {
        }
        public DbSet<City> Citys { get; set; }
        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            //Configure domain classes using Fluent API here

            base.OnModelCreating(modelBuilder);
        }
    }
}
