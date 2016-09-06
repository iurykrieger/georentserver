using GeoRent.Domain.Entities;
using System.Data.Entity.ModelConfiguration;

namespace GeoRent.Infra.Data.EntityConfig
{
    public class UserConfig : EntityTypeConfiguration<User>
    {
        public UserConfig()
        {
            ToTable("User");
        }
    }
}