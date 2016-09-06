using GeoRent.Domain.Entities;
using System.Data.Entity.ModelConfiguration;

namespace GeoRent.Infra.Data.EntityConfig
{
    public class UserImageConfig : EntityTypeConfiguration<UserImage>
    {
        public UserImageConfig()
        {
            ToTable("UserImage");
        }
    }
}